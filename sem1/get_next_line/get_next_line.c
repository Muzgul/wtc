//Enter header here
#include <stdio.h>
#include "get_next_line.h"

int		count_size(t_list **head, int clear)
{
	t_list	*current;
	t_list	*prev;
	int		count;

	count = 0;
	while ((current = *head) != NULL && clear != 2)
	{
		prev = current;
		while (current->next != NULL && (prev = current) != NULL)
		{
			count += current->content_size;
			current = current->next;
		}
		count += current->content_size;
		if (clear == 1)
		{
			prev->next = NULL;
			if (current == prev)
				*head = NULL;
			free(current);
		}
		else
			clear = 2;
	}
	return (count);
}

int		make_line(char **line, t_list **head)
{
	t_list	*current;
	char	*tempstr;
	char	*templine;
	int		tempint;

	if (head == NULL)
		return (-1);
	tempint = count_size(head, 0);
	*line = ft_strnew(tempint);
	current = *head;
	while (current != NULL && current->content != NULL)
	{
		tempstr = ft_strnew(current->content_size);
		tempstr = ft_strncpy(tempstr, current->content, current->content_size);
		templine = *line;
		*line = ft_strjoin(templine, tempstr);
		ft_strdel(&templine);
		ft_strdel(&tempstr);
		current = current->next;
	}
	count_size(head, 1);
	return (tempint);
}

int		manage_temp(t_list **head, char *temp, char **save, int readstatus)
{
	t_list	*new;
	int		tempint;

	tempint = ft_strsearch(temp, '\n');
	if (tempint >= 0)
	{
		if (tempint > 0)
			new = ft_lstnew(temp, tempint);
		readstatus = -2;
		if (tempint == 0 && count_size(head, 0) == 0)
		{
			if (temp[0] == temp[1])
				readstatus = -3;
			else
				readstatus = 1;
			(*save) = ft_strdup(&temp[1]);
		}
		else if (tempint != (BUFF_SIZE - 1))
			(*save) = ft_strdup(&temp[tempint]);
	}
	if (tempint == -1)
		new = ft_lstnew(temp, ft_strlen(temp));
	if (tempint != 0)
		ft_lstadd(head, new);
	return (readstatus);
}

int		read_to_list(const int fd, t_list **head)
{
	static char	*save = NULL;
	char		*temp;
	char		buff[BUFF_SIZE + 1];
	int			readstatus;

	readstatus = 1;
	if (save != NULL && ft_strlen(save) > 0)
	{
		temp = ft_strdup(save);
		ft_strdel(&save);
		save = NULL;
	}
	else
	{
		if ((readstatus = read(fd, buff, BUFF_SIZE)) <= 0)
			return (readstatus);
		buff[readstatus] = '\0';
		temp = ft_strdup((char *)&buff);
	}
	readstatus = manage_temp(head, temp, &save, readstatus);
	if (temp != NULL)
		ft_strdel(&temp);
	return (readstatus);
}

int		get_next_line(const int fd, char **line)
{
	int		readstatus;
	int		makestatus;
	t_list	*head;

	if (line == NULL)
		return (-1);
	readstatus = 1;
	head = NULL;
	while (readstatus > 0)
	{
		readstatus = read_to_list(fd, &head);
	}
	makestatus = make_line(line, &head);
	if (readstatus == -3)
	{
		(*line) = ft_strnew(1);
		return (1);
	}
	if (readstatus == 0 && makestatus == 0)
		return (0);
	if (readstatus == -2 || makestatus > 0)
		return (1);
	return (-1);
}
