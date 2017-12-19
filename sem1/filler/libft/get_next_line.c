/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/12/16 17:44:31 by mmacdona          #+#    #+#             */
/*   Updated: 2017/12/16 17:44:37 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

int		count_size(t_list **head)
{
	t_list	*current;
	int		count;

	count = 0;
	current = *head;
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
	char	*tempstr;
	char	*templine;
	int		tempint;

	if (head == NULL)
		return (-1);
	tempint = count_size(head);
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
	ft_lstclr(head);
	return (tempint);
}

int		manage_temp(t_list **head, char *temp, char **save, int readstatus)
{
	t_list	*new;
	int		tempint;

	tempint = ft_strsearch(temp, '\n');
	if (tempint >= 0 && tempint != readstatus - 1)
		(*save) = ft_strdup(&temp[tempint + 1]);
	if (tempint > 0)
		temp[tempint] = '\0';
	if (tempint != 0)
	{
		new = ft_lstnew(temp, ft_strlen(temp));
		ft_lstadd(head, new);
	}
	if (tempint >= 0)
		return (-2);
	else
		return (1);
}

int		read_to_list(const int fd, t_list **head)
{
	static char *save = NULL;
	char		*temp;
	char		buff[BUFF_SIZE];
	int			readstatus;

	if (save != NULL)
	{
		temp = ft_strdup(save);
		ft_strdel(&save);
		readstatus = ft_strlen(temp);
		save = NULL;
	}
	else
	{
		readstatus = read(fd, buff, BUFF_SIZE);
		if (readstatus <= 0)
			return (readstatus);
		temp = ft_strnew(readstatus);
		ft_strncpy(temp, buff, readstatus);
	}
	readstatus = manage_temp(head, temp, &save, readstatus);
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
		readstatus = read_to_list(fd, &head);
	makestatus = make_line(line, &head);
	if (readstatus == 0)
	{
		if (makestatus > 0)
			return (1);
		return (0);
	}
	if (readstatus == -2)
	{
		if (makestatus <= 0)
			(*line) = ft_strdup("\0");
		return (1);
	}
	return (-1);
}
