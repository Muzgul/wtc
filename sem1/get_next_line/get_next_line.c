//Enter header here
#include <stdio.h>
#include "get_next_line.h"

int		count_size(t_list **head)
{
	t_list	*current;
	int		count;

	current = *head;
	count = 0;
	while (current != NULL)
	{
		count += current->content_size;
		current = current->next;
	}
	return (count);
}

int		make_line(char **line, t_list **head)
{
	t_list	*current;
	t_list	*prev;
	char 	*tempStr;
	char	*tempLine;
	int		tempInt;

	if (head == NULL)
		return (-1);
	*line = ft_strnew(count_size(head));
	current = *head;
	while (current != NULL && current->content != NULL)
	{
		tempStr = ft_strnew(current->content_size);
		tempStr = ft_strncpy(tempStr, current->content, current->content_size);
		tempLine = *line;
		*line = ft_strjoin(tempLine, tempStr);
		ft_strdel(&tempLine);
		ft_strdel(&tempStr);
		current = current->next;
	}
	tempInt = count_size(head);
	(*line)[tempInt] = '\0';
	while (*head != NULL)
	{
		current = *head;
		prev = current;
		while (current->next != NULL)
		{
			prev = current;
			current = current->next;
		}
		if (current == prev)
			*head = NULL;
		else
			prev->next = NULL;
		free(current);
	}
	return (tempInt);
}

int		read_to_list(const int fd, t_list **head)
{
	static char	*save = NULL;
	char		*temp;
	char		buff[BUFF_SIZE + 1];
	int 		readStatus;
	int			tempInt;
	t_list		*new;

	temp = ft_strnew(BUFF_SIZE + 1);
	readStatus = 1;
	if (save != NULL && ft_strlen(save) > 0)
	{
		ft_strcpy(temp, save);
		ft_strdel(&save);
		save = NULL;
	}
	else
	{
		readStatus = read(fd, buff, BUFF_SIZE);
		if (readStatus <= 0)
		{
			return (readStatus);
		}
		buff[readStatus] = '\0';
		ft_strcpy(temp, (char *)&buff);
	}
	
	tempInt = ft_strsearch(temp, '\n');
	if (tempInt >= 0)
	{
		if (tempInt > 0)
			new = ft_lstnew(temp, tempInt);
		if (tempInt != (BUFF_SIZE - 1) && tempInt != 0)
		{
			save = ft_strnew(BUFF_SIZE - tempInt);
			ft_strcpy(save, &temp[tempInt]);
		}
		if (tempInt == 0)
		{
			save = ft_strnew(BUFF_SIZE - 1);

			if (count_size(head) == 0)
			{
				if (temp[0] == temp[1])
				{
					ft_strcpy(save, &temp[1]);
					return (-3);
				}
				else
				{
					ft_strcpy(save, &temp[1]);
					return (1);
				}
			}
			ft_strcpy(save, &temp[0]);
			return (-2);
		}
		readStatus = -2;
	}
	if (tempInt == -1)
		new = ft_lstnew(temp, ft_strlen(temp));
	if (temp != NULL)
		ft_strdel(&temp);
	ft_lstadd(head, new);
	return (readStatus);
}

int		get_next_line(const int fd, char **line)
{
	int		readStatus;
	int		makeStatus;
	t_list	*head;

	if (line == NULL)
		return (-1);
	readStatus = 1;
	head = NULL;
	while (readStatus > 0)
	{
		readStatus = read_to_list(fd, &head);
	}
	makeStatus = make_line(line, &head);
	if (readStatus == -3)
	{
		(*line) = ft_strnew(1);
		return (1);
	}
	if (readStatus == 0 && makeStatus == 0)
		return (0);
	if (readStatus == -2 || makeStatus > 0)
		return (1);
	return (-1);
}