/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/06/22 15:17:47 by mmacdona          #+#    #+#             */
/*   Updated: 2017/06/23 12:21:38 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdio.h>

#include "get_next_line.h"

int		line_end(t_list **head)
{
	t_list *current;
	//printf("line_end\n");

	if (*head == NULL)
		return (0);
	if ((*head)->content == NULL)
		return (1);
	current = *head;
	while (current->next != NULL)
		current = current->next;
	if (current->content == NULL)
		return (1);	
	if (ft_strsearch(current->content, '\n') != 0 ||
		ft_strsearch(current->content, -1) != 0)
		return (1);
	return (0);
}

size_t	read_to_list(const int fd, t_list **head)
{
	//printf("read_to_list\n");
	char		buff[BUFF_SIZE + 1];
	static char	*temp = NULL;
	int			readVal;

	readVal = -1;
	if (temp != NULL)
	{
		ft_strcpy((char *)&buff, temp);
		free(temp);
		temp = NULL;

	}
	else
	{
		readVal = read(fd, buff, BUFF_SIZE);
		if (readVal == 0)
			return (1);
		buff[BUFF_SIZE] = '\0';
	}
	
	//printf("Buff: %s\n", buff);
	if (ft_strsearch((char *)buff, '\n') != 0)
	{
		new = ft_lstnew((void*)buff, ft_strsearch(buff, '\n') + 1);
		if (ft_strsearch((char *)buff, '\n') != (BUFF_SIZE - 1))
		{
			temp = ft_strnew(BUFF_SIZE - ft_strsearch(buff, '\n') + 1);
			ft_strcpy(temp, &buff[ft_strsearch(buff, '\n') + 1]);
		}
	}
	else
	{
		if (ft_strsearch(buff, -1) != 0)
			new = ft_lstnew((void*)buff, ft_strsearch(buff, -1));
		else
			new = ft_lstnew((void*)buff, ft_strlen(buff));
		if (buff[0] == '\n' && readVal == 1)
			new->content = NULL;
	}
	ft_lstadd(head, new);
	printf("New: %s\n", new->content);
	return (0);
}

int		count_size(t_list **head)
{
	//printf("count_size\n");
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

void	make_line(char **line, t_list **head)
{
	//printf("make_line\n");
	t_list	*current;
	char 	*tempStr;
	size_t	tempInt;

	*line = ft_strnew(count_size(head));
	current = *head;
	while (current != NULL && current->content != NULL)
	{
		if ((tempInt = ft_strsearch(current->content, '\n')) != 0)
		{
			tempStr = ft_strnew(tempInt);
			tempStr = ft_strncpy(tempStr, current->content, tempInt);
		}
		else
			tempStr = current->content;
		*line = ft_strjoin(*line, tempStr);
		current = current->next;
	}
	(*line)[count_size(head)] = '\0';
}

int		get_next_line(const int fd, char **line)
{
	t_list *head;
	int		tempInt;

	head = NULL;
	tempInt = 0;
	while (line_end(&head) == 0 && tempInt == 0)
	{
		tempInt = read_to_list(fd, &head);
	}
	if (count_size(&head) == 0)
		return (0);
	make_line(line, &head);
	return (1);
}
